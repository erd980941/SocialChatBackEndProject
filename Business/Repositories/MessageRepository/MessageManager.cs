using Business.Aspect.Secured;
using Business.Repositories.MessageRepository.Validation.FluentValidation;
using Business.Repositories.OperationClaimRepository.Validation.FluentValidation;
using Core.Aspect.Validation;
using Core.Utilities.Business;
using Core.Utilities.Result.Abstract;
using Core.Utilities.Result.Concrete;
using DataAccess.Repositories.MessageRepository;
using DataAccess.Repositories.UserRepository;
using Entities.Concrete;
using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.MessageRepository
{
    public class MessageManager : IMessageService
    {
        private readonly IMessageDal _messageDal;
        private readonly IUserDal _userDal;

        public MessageManager(IMessageDal messageDal, IUserDal userDal)
        {
            _messageDal = messageDal;
            _userDal = userDal;
        }
        [SecuredAspect]
        [ValidationAspect(typeof(MessageValidator))]
        public IResult AddMessage(Message message)
        {
            var ısUserExistResult = BusinessRules.Run(IsUserExist(message.ReceiverId));
            if (!ısUserExistResult.Success) return ısUserExistResult;
            _messageDal.Add(message);
            return new SuccessResult();
        }

        [SecuredAspect]
        public IResult DeleteMessage(Message message)
        {
            _messageDal.Delete(message);
            return new SuccessResult();
        }

        [SecuredAspect]
        public IDataResult<List<User>> GetChatUsers(int userId)
        {
            var chatUsers= _messageDal.GetAll(m=>m.SenderId == userId || m.ReceiverId==userId)
                            .Select(m => m.SenderId == userId ? m.ReceiverId : m.SenderId).Distinct().ToList();

            var users = _userDal.GetAll(u => chatUsers.Contains(u.Id));

            return new SuccessDataResult<List<User>>(users);
        }

        [SecuredAspect]
        public IDataResult<List<Message>> GetConversationMessages(int userId,int receiverId)
        {
            var messages=_messageDal.GetAll(m=> (m.SenderId == userId && m.ReceiverId == receiverId) ||
                                                (m.SenderId == receiverId && m.ReceiverId == userId));

            return new SuccessDataResult<List<Message>>(messages);
        }

        [SecuredAspect]
        private IResult IsUserExist(int userId)
        {
            var user=_userDal.Get(p=>p.Id == userId);
            if (user == null) return new ErrorResult("Kullanıcı Bulunamadı");
            return new SuccessResult();
        }
    }
}
