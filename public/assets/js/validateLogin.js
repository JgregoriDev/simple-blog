
const form = document.querySelector("#form");
form.addEventListener("submit", (e) => {
  e.preventDefault();
  const username=$('username');
  console.log(username);
  const password=$('password');
  const helpUser=$('helpUsername');
  helpUser.innerHTML=``;
  const helpPassword=$('helpPassword');
  helpPassword.innerHTML=``;
  let userLenghtStatus=validateLenghtField(username,0);
  if(!userLenghtStatus){
    helpUser.innerHTML="El campo usuario no puede estar vacio"; 
  }
  userLenghtStatus= validateEmail(username);
  if(!userLenghtStatus){
    helpUser.innerHTML="El campo usuario debe cumplir el formato de correo electronico"; 
  }
  let passwordLenghtStatus=validateLenghtField(password,6);
  if(!passwordLenghtStatus){
    helpPassword.innerHTML="El campo contraseña no puede estar vacio ni tener menos de 6 caracteres";
  }
  if(userLenghtStatus && passwordLenghtStatus){
    // form.submit();
  }
});
const validateLenghtField=(fieldToValidateLength, minLength)=>{
  if( fieldToValidateLength===null || fieldToValidateLength.value.length <= minLength){
    return false;
  }
  return true;
}
const validateEmail=(emailField)=>{
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if(!emailPattern.test(emailField.value)){
    return false;
  }
  return true;
}
const $=(name)=>{
  return document.getElementById(`${name}`);
}
