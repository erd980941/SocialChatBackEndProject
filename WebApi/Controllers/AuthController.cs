using Business.Authentication;
using Core.Utilities.Result.Concrete;
using Entities.Dtos;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace WebApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AuthController : ControllerBase
    {
        private readonly IAuthService _authService;

        public AuthController(IAuthService authService)
        {
            _authService = authService;
        }

        [HttpPost("[action]")]
        public IActionResult Register([FromForm]RegisterAuthDto registerAuthDto)
        {
            

            var result= _authService.Register(registerAuthDto);
            if(result.Success) return Ok(result);
            return BadRequest(result);
        }

        [HttpPost("[action]")]
        public IActionResult Login(LoginAuthDto loginAuthDto)
        {
            var result = _authService.Login(loginAuthDto);
            if (result.Success) return Ok(result);
            return BadRequest(result);
        }
    }
}
