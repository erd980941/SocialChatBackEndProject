﻿using Core.Utilities.Result.Abstract;
using Entities.Concrete;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.EmailParameterRepository
{
    public interface IEmailParameterService
    {
        IResult Add(EmailParameter emailParameter);
        IResult Update(EmailParameter emailParameter);
        IResult Delete(EmailParameter emailParameter);
        IDataResult<EmailParameter> GetById(int id);
        IDataResult<List<EmailParameter>> GetList();
        IResult SendEmail(EmailParameter emailParameter,string body, string subject, string emails);
    }
}
