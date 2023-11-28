document.addEventListener('DOMCotentLoaded', function(){
  var from = document.getElementById('#form')
  from.addEventListener('submit',function(event){
    var inputs = document.querySelectorAll('input,select')
    var allFieldsFilled = true
    inputs.forEach(function(input){
      if(input.hasAttribute('required') && !input.value.trim()){
        allFieldsFilled = false
      }
    })
    if(!allFieldsFilled){
      event.preventDefault()
      alert('Please fill in all required fields.')
    }
  })
})