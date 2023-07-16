function isNumberKey(evt) {
    if (evt.which == 101 || evt.which == 46 || evt.which == 69 || evt.which == 45 || evt.which == 43) {
        evt.preventDefault();
    }
}
 

let register_btn = document.getElementById('register-btn');
register_btn.addEventListener('click',(event)=>{
    const validName = new RegExp('[a-zA-Z ]+$');
    const validEmailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const validNumberRegex = /^[0-9]+$/;
    let name = $('#name').val();
    let email = $('#email').val();
    let phone = $('#phone').val();
    let password = $('#password').val();
    if(name==""){
        alert('Enter your full name');
        $('#name').focus();
        event.preventDefault();
    } else if(!name.match(validName)){
        alert('Enter valid name. Allow only alphabets(a-z,A-Z)');
        $('#name').focus();
        event.preventDefault();
    } else if(email==""){
        alert('Enter your email address');
        $('#email').focus();
        event.preventDefault();
    } else if(!email.match(validEmailRegex)){
        alert('Enter a valid email address');
        $('#email').focus();
        event.preventDefault();
    } else if(phone==""){
        alert('Enter your phone number');
        $('#phone').focus();
        event.preventDefault();
    } else if(!phone.match(validNumberRegex)){
        alert('Enter valid phone number. Allow only numeric(0-9)');
        $('#phone').focus();
        event.preventDefault();
    } else if(phone.length !== 10){
        alert('Phone number should be 10 digit');
        $('#phone').focus();
        event.preventDefault();
    } else if(password==""){
        alert('Enter your password');
        $('#password').focus();
        event.preventDefault();
    } else if(password.length < 6){
        alert('Password greater than 6 digit');
        $('#password').focus();
        event.preventDefault();
    }
});



