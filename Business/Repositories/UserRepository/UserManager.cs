using Business.Repositories.UserRepository.Constans;
using Business.Repositories.UserRepository.Validation.FluentValidation;
using Business.Utilities.File;
using Core.Aspect.Caching;
using Core.Aspect.Transaction;
using Core.Aspect.Validation;
using Core.Utilities.Hashing;
using Core.Utilities.Result.Abstract;
using Core.Utilities.Result.Concrete;
using DataAccess.Repositories.UserRepository;
using Entities.Concrete;
using Entities.Dtos;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.UserRepository
{
    public class UserManager : IUserService
    {
        private readonly IUserDal _userDal;
        private readonly IFileService _fileService;

        public UserManager(IUserDal userDal, IFileService fileService)
        {
            _userDal = userDal;
            _fileService = fileService;
        }

        [RemoveCacheAspect("IUserService.GetList")]
        public IResult Add(RegisterAuthDto registerDto)
        {
            string fileName = _fileService.FileSaveToServer(registerDto.Image, "./Content/img/");
            var user = CreateUser(registerDto, fileName);
            _userDal.Add(user);
            return new SuccessResult(UserMessages.Added);

        }
        private User CreateUser(RegisterAuthDto authDto, string fileName)
        {
            byte[] passwordHash, passwordSalt;
            HashingHelper.CreatePassword(authDto.Password, out passwordHash, out passwordSalt);

            User user = new User();
            user.Id = 0;
            user.Email = authDto.Email;
            user.Name = authDto.Name;
            user.PasswordHash = passwordHash;
            user.PasswordSalt = passwordSalt;
            user.ImageUrl = fileName;
            return user;
        }

        [ValidationAspect(typeof(UserValidator))]
        [TransactionAspect]
        [RemoveCacheAspect("IUserService.GetList")]
        public IResult Update(User user)
        {
            _userDal.Update(user);
            return new SuccessResult(UserMessages.Updated);
        }

        [ValidationAspect(typeof(UserChangePasswordValidator))]
        public IResult ChangePassword(UserChangePasswordDto userChangePasswordDto)
        {
            var user = _userDal.Get(p => p.Id == userChangePasswordDto.UserId);
            bool result = HashingHelper.VerifyPasswordHash(userChangePasswordDto.CurrentPassword, user.PasswordHash, user.PasswordSalt);
            if (!result) return new ErrorResult(UserMessages.WrongCurrentPassword);
            byte[] passwordHash, passwordSalt;
            HashingHelper.CreatePassword(userChangePasswordDto.NewPassword, out passwordHash, out passwordSalt);
            user.PasswordHash = passwordHash;
            user.PasswordSalt = passwordSalt;
            _userDal.Update(user);
            return new SuccessResult(UserMessages.PasswordChanged);
        }

        [RemoveCacheAspect("IUserService.GetList")]
        public IResult Delete(User user)
        {
            _userDal.Delete(user);
            return new SuccessResult(UserMessages.Deleted);
        }

        public User GetByEmail(string email)
        {
            return _userDal.Get(p => p.Email == email);
        }

        [CacheAspect(60)]
        public IDataResult<List<User>> GetList()
        {
            return new SuccessDataResult<List<User>>(_userDal.GetAll());
        }


        public IDataResult<User> GetById(int id)
        {
            return new SuccessDataResult<User>(_userDal.Get(p=>p.Id==id));
        }

        public List<OperationClaim> GetUserOperationClaim(int userId)
        {
            return _userDal.GetUserOperationClaim(userId);
        }
    }
}
