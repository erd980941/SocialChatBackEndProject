using Core.DataAccess;
using Core.DataAccess.EntityFramework;
using DataAccess.Context.EntityFramework;
using DataAccess.Repositories.UserRepository;
using Entities.Concrete;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Linq.Expressions;
using System.Text;
using System.Threading.Tasks;

namespace DataAccess.Repositories.MessageRepository
{
    public class EfMessageDal : EfEntityRepositoryBase<Message, SimpleContextDb>, IMessageDal
    {
       
    }
}
