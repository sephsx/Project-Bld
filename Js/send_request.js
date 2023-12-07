function sendRequesterEmail(requesterId, status){
  fetch('send_requester_email.phph',{
    method : 'POST',
    headers : {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    
  })
}