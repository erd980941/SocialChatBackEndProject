using Business.Repositories.EmailParameterRepository;
using Business.Repositories.OperationClaimRepository;
using Entities.Concrete;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace WebApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class EmailParametersController : ControllerBase
    {
        private readonly IEmailParameterService _emailParameterService;

        public EmailParametersController(IEmailParameterService emailParameterService)
        {
            _emailParameterService = emailParameterService;
        }

        [HttpPost("[action]")]
        public IActionResult Add(EmailParameter emailParameter)
        {
            var result = _emailParameterService.Add(emailParameter);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult Update(EmailParameter emailParameter)
        {
            var result = _emailParameterService.Update(emailParameter);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult Delete(EmailParameter emailParameter)
        {
            var result = _emailParameterService.Delete(emailParameter);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GetList()
        {
            var result = _emailParameterService.GetList();
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GeyById(int id)
        {
            var result = _emailParameterService.GetById(id);
            if (result.Success) return Ok(result);
            return BadRequest(result.Message);
        }
    }
}
