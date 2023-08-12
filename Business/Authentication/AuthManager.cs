using Business.Authentication.Validation.FluentValidation;
using Business.Repositories.UserRepository;
using Core.Aspect.Validation;
using Core.CrossCuttingConcerns.Validation;
using Core.Utilities.Business;
using Core.Utilities.Hashing;
using Core.Utilities.Result.Abstract;
using Core.Utilities.Result.Concrete;
using Core.Utilities.Security.JWT;
using Entities.Concrete;
using Entities.Dtos;
using FluentValidation.Results;
using Microsoft.AspNetCore.Http;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Authentication
{
    public class AuthManager : IAuthService
    {
        private readonly IUserService _userService;
        private readonly ITokenHandler _tokenHandler;

        public AuthManager(IUserService userService, ITokenHandler tokenHandler)
        {
            _userService = userService;
            _tokenHandler = tokenHandler;
        }

        public IDataResult<Token> Login(LoginAuthDto loginDto)
        {
            var user =  _userService.GetByEmail(loginDto.Email);
            var result = HashingHelper.VerifyPasswordHash(loginDto.Password, user.PasswordHash, user.PasswordSalt);
            List<OperationClaim> operationClaims= _userService.GetUserOperationClaim(user.Id);
            if (result)
            {
                Token token = new Token();
                token = _tokenHandler.CreateToken(user, operationClaims);
                return new SuccessDataResult<Token>(token);
            }
            return new ErrorDataResult<Token>("Mail ya da Şifre Hatalı");
        }

        [ValidationAspect(typeof(AuthValidator))]
        public IResult Register(RegisterAuthDto registerDto)
        {

            IResult result = BusinessRules.Run(
                    CheckIfEmailExist(registerDto.Email),
                    CheckIfImageSizeIsLessThanOneMb(registerDto.Image.Length),
                    CheckIfImageExtensionsAllow(registerDto.Image.FileName)
                );

            if (!result.Success) return result;

            var isAdded=  _userService.Add(registerDto);
            if (!isAdded.Success) return new ErrorResult(isAdded.Message);
            return new SuccessResult("Kayıt Başarılı");


        }

        /*------------------Business Kontrolleri------------------*/
        private IResult CheckIfEmailExist(string email)
        { 
            var list=_userService.GetByEmail(email);
            if (list != null)
            {
                return new ErrorResult("Bu Mail Adresi Kullanılıyor.");
            }
            return new SuccessResult();
        }
        private IResult CheckIfImageSizeIsLessThanOneMb(long imgSize)
        {
            decimal imgMbSize = Convert.ToDecimal(imgSize * 0.000001);
            if (imgMbSize > 1) return new ErrorResult("Yüklediğiniz Resim Boyutu 1MB'dan Büyük Olamaz.");
            else return new SuccessResult();
        }
        private IResult CheckIfImageExtensionsAllow(string fileName)
        {
            var ext = fileName.Substring(fileName.LastIndexOf('.'));
            var extension = ext.ToLower();
            List<string> AllowFileExtensions = new List<string>() { ".jpg", ".jpeg", ".png", ".gif" };
            if (!AllowFileExtensions.Contains(extension))
            {
                return new ErrorResult("Eklediğiniz Resim Formatlarımıza Uygun Değildir.");
            }
            return new SuccessResult();
        }
    }
}
