using Business.Repositories.MessageRepository;
using Business.Repositories.OperationClaimRepository;
using Entities.Concrete;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace WebApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class MessagesController : ControllerBase
    {
        private readonly IMessageService _messageService;

        public MessagesController(IMessageService messageService)
        {
            _messageService = messageService;
        }

        [HttpPost("[action]")]
        public IActionResult AddMessage(Message message)
        {
            var result = _messageService.AddMessage(message);
            if (result.Success) return Ok(result.Success);
            return BadRequest(result.Message);
        }

        [HttpPost("[action]")]
        public IActionResult DeleteMessage(Message message)
        {
            var result = _messageService.DeleteMessage(message);
            if (result.Success) return Ok(result.Success);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GetConversationMessages(int userId,int receiverId)
        {
            var result=_messageService.GetConversationMessages(userId,receiverId);
            if (result.Success) return Ok(result.Data);
            return BadRequest(result.Message);
        }

        [HttpGet("[action]")]
        public IActionResult GetChatUsers(int userId)
        {
            var result = _messageService.GetChatUsers(userId);
            if (result.Success) return Ok(result.Data);
            return BadRequest(result.Message);
        }

    }
}
