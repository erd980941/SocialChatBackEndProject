using Business.Aspect.Secured;
using Business.Repositories.OperationClaimRepository.Constans;
using Business.Repositories.OperationClaimRepository.Validation.FluentValidation;
using Core.Aspect.Caching;
using Core.Aspect.Performance;
using Core.Aspect.Validation;
using Core.Utilities.Business;
using Core.Utilities.Result.Abstract;
using Core.Utilities.Result.Concrete;
using DataAccess.Repositories.OperationClaimRepository;
using Entities.Concrete;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Business.Repositories.OperationClaimRepository
{
    public class OperationClaimManager : IOperationClaimService
    {
        private readonly IOperationClaimDal _operationClaimDal;

        public OperationClaimManager(IOperationClaimDal operationClaimDal)
        {
            _operationClaimDal = operationClaimDal;
        }

        [ValidationAspect(typeof(OperationClaimValidator))]
        [RemoveCacheAspect("IOperationClaimService.GetList")]
        public IResult Add(OperationClaim operationClaim)
        {
            IResult result=BusinessRules.Run(IsNameExistForAdd(operationClaim.Name));
            if(!result.Success) { return result; }
            _operationClaimDal.Add(operationClaim);
            return new SuccessResult(OperationClaimMessages.Added);
        }

        [ValidationAspect(typeof(OperationClaimValidator))]
        [RemoveCacheAspect("IOperationClaimService.GetList")]
        public IResult Update(OperationClaim operationClaim)
        {
            IResult result = BusinessRules.Run(IsNameExistForUpdate(operationClaim));
            if (!result.Success) { return result; }
            _operationClaimDal.Update(operationClaim);
            return new SuccessResult(OperationClaimMessages.Updated);
        }

        [RemoveCacheAspect("IOperationClaimService.GetList")]
        public IResult Delete(OperationClaim operationClaim)
        {
            _operationClaimDal.Delete(operationClaim);
            return new SuccessResult(OperationClaimMessages.Deleted);
        }

        public IDataResult<OperationClaim> GetById(int id)
        {
            return new SuccessDataResult<OperationClaim>(_operationClaimDal.Get(p=>p.Id == id));
        }

        [CacheAspect(60)]
        [SecuredAspect("Admin")]
        [PerformanceAspect]
        public IDataResult<List<OperationClaim>> GetList()
        {
            return new SuccessDataResult<List<OperationClaim>>(_operationClaimDal.GetAll());
        }


        private IResult IsNameExistForAdd(string name)
        {
            var result=_operationClaimDal.Get(p=>p.Name == name);
            if (result != null) { return new ErrorResult(OperationClaimMessages.NameIsNotAvailable); }
            return new SuccessResult();
        }
        private IResult IsNameExistForUpdate(OperationClaim operationClaim)
        {
            var currentOperationClaim = _operationClaimDal.Get(p => p.Id == operationClaim.Id);
            if(currentOperationClaim.Name != operationClaim.Name) 
            { 
                var result = _operationClaimDal.Get(p => p.Name == operationClaim.Name);
                if (result != null) { return new ErrorResult(OperationClaimMessages.NameIsNotAvailable); }
            }
            return new SuccessResult();
        }


    }
}
