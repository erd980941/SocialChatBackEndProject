using Business.Repositories.OperationClaimRepository;
using Business.Repositories.UserOperationClaimRepository;
using Entities.Concrete;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace WebApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class UserOperationClaimsController : ControllerBase
    {
        private readonly IUserOperationClaimService _userOperationClaimService;

        public UserOperationClaimsController(IUserOperationClaimService userOperationClaimService)
        {
            _userOperationClaimService = userOperationClaimService;
        }


        [HttpPost("[action]")]
        public IActionResult Add(UserOperationClaim userOperationClaim)
        {
            var result = _userOperationClaimService.Add(userOperationClaim);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult Update(UserOperationClaim userOperationClaim)
        {
            var result = _userOperationClaimService.Update(userOperationClaim);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult Delete(UserOperationClaim userOperationClaim)
        {
            var result = _userOperationClaimService.Delete(userOperationClaim);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GetList()
        {
            var result = _userOperationClaimService.GetList();
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GeyById(int id)
        {
            var result = _userOperationClaimService.GetById(id);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }
    }
}
