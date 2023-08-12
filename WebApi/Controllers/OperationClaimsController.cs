using Business.Repositories.OperationClaimRepository;
using Entities.Concrete;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace WebApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class OperationClaimsController : ControllerBase
    {
        private readonly IOperationClaimService _operationClaimService;

        public OperationClaimsController(IOperationClaimService operationClaimService)
        {
            _operationClaimService = operationClaimService;
        }

        [HttpPost("[action]")]
        public IActionResult Add(OperationClaim operationClaim)
        {
            var result = _operationClaimService.Add(operationClaim);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult Update(OperationClaim operationClaim)
        {
            var result = _operationClaimService.Update(operationClaim);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult Delete(OperationClaim operationClaim)
        {
            var result = _operationClaimService.Delete(operationClaim);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GetList()
        {
            var result = _operationClaimService.GetList();
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GeyById(int id)
        {
            var result = _operationClaimService.GetById(id);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }
    }
}
