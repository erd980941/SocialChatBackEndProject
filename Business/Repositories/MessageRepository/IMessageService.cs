using Core.Utilities.Result.Abstract;
using Entities.Concrete;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.MessageRepository
{
    public interface IMessageService
    {
        IResult AddMessage(Message message);
        IResult DeleteMessage(Message message);
        IDataResult<List<Message>> GetConversationMessages(int userId,int receiverId);
        IDataResult<List<User>> GetChatUsers(int userId);
    }
}
