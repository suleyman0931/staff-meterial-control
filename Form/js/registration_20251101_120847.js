
document.getElementById("registration").addEventListener("submit", function(event){
 
    // console.log("daniel");
        var isValid=true;
        var id=document.getElementById("universityId").value;
        var fullName= document.getElementById("fullName").value;
        var birthDate=document.getElementById("birthDate").value;
        var gpa=document.getElementById("gpa").value;
        var gender=document.querySelector('input[name="gender"]:checked');
        var batch=document.getElementById("batch").value;
        // var remark=document.getElementById("remark").value;

        var idValue =document.getElementById("universityId");
        var fullNameValue = document.getElementById("fullName");
        var birthDateError =document.getElementById("birthError");
        var gpaError=document.getElementById("gpaError");

        var genderError = document.getElementById('genderError');
        var batchError  = document.getElementById("batchError");
        // var messageError = document.getElementById("messageError");

 
        idValue.classList.remove("error");
        fullNameValue.classList.remove("error");


        idError.textContent="";
        nameError.textContent="";
        birthDateError.textContent="";
        gpaError.textContent="";
        departmentError.textContent="";
        batchError.textContent="";
        messageError.textContent="";


        var idPattern=/^Wdu\d{6}$/;
        var check=/^WDU\d{6}$/;
        const Space=/\s/;

        //id validation 

        if(id===""){
            idValue.classList.add("error");
            idError.textContent = "University ID is required";
            isValid = false;
        }
        else if (!check.test(id)){
            idValue.classList.add("error");
            idError.textContent = "The id form should be WDU then 6 number .";
            isValid = false;
        }
        else if( id.length < 9){
            idError.textContent="id must be 9 character";
            isValid=false;
        }
      
        //name validation

        if(fullName===""){
            fullNameValue.classList.add("error");
            nameError.textContent = "Name is required";
            isValid = false;
        }
        else if(fullName.value<3){
            fullNameValue.classList.add("error");
            nameError.textContent = "Name must be at least 3 characters";
            isValid = false;
        }    else if(! /\s/.test(fullName)){
                name_error.textContent=" Space is required between your name ";
                isValid=false;
            }

            // birthDate validation
        // var today=new Date();
        // var age =today.getFullYear()-birthDate.getFullYear();
        // var temp = today.getMonth()-birthDate.getMonth();
        // if(temp<0||(temp=== 0 && today.getDate()<birthDate.getDate())){
        //     age--;
        // }
        // if(age<18){
        //     birthDateError.textContent="you must be at least 18 years old";
        //     isValid=false;
        // }

        // function isNumber(input) {
        //     return !isNaN(input);
        // }
        
        // // Example usage:
        // var userInput = "123"; // Change this to the user's input
        // if (isNumber(userInput)) {
        //     console.log("Input is a number!");
        // } else {
        //     console.log("Input is not a number!");
        // }
        


        // function isNumber(input) {
        //     return /^\d+$/.test(input);
        // }
        
        // // Example usage:
        // var userInput = "123"; // Change this to the user's input
        // if (isNumber(userInput)) {
        //     console.log("Input is a number!");
        // } else {
        //     console.log("Input is not a number!");
        // }

        
                
        if(birthDate===""){
            birthDateError.textContent = "Birth date is required";
            isValid = false;
        }else if (!isAbove18(birthDate)) {
            birthDateError.textContent="you must be at least 18 years old";
            isValid=false;
        } 
        




        
        // if(birthDate===""){
        //     birthDateError.textContent = "Birth date is required";
        //     isValid = false;
        // }
    


        //cgpa validation

        if(gpa==='') {   
            gpaError.textContent="your gpa  is required";
            isValid=false;
        }else if(gpa < 2 || gpa >4){

            gpaError.textContent="your gpa  must between 2 and 4";
            isValid=false;
        }

        // gender validation

        if(!gender){
           genderError.textContent="gender is required";
           isValid=false;
           }

        //batch validation

        if( batch ===''){   
            batchError.textContent="your batch  is required";
            isValid=false;
        }else if(isNaN(batch)){   
            batchError.textContent="your batch input must be a number";
            isValid=false;
        }else if(batch < 1 || batch >6){
            batchError.textContent="your batch  must between 1 and 6";
            isValid=false;
        }


       // remark validation
    //    alert("This is");
    //    if(remark===""){
    //     messageError.textContent="Message should not be null";
    //     isValid=false;
    //     }


    if (isValid) {
        // If all inputs are valid, log form values to console
        // console.log("Form submitted successfully!");
        // console.log("Id:", id);
        // console.log("Name:", fullName);
        // console.log("Birth date:", birthDate);
        // console.log("GPA:", gpa);
        // console.log("Department:", department);
        // console.log("Gender:", gender.value);
        // console.log("Batch:", Batch);
        // console.log("Remarks:", remarks);
  
      } else {
        event.preventDefault();
      }
});
function resetForm() { 
    document.getElementById("registration").reset(); 
    var errorElements = document.getElementsByClassName("error"); 
    for (var i = 0; i < errorElements.length; i++) { 
      errorElements[i].textContent = ""; 
    } 
  }
// document.getElementById("registration").addEventListener("", function(event){
    
    
//     // document.getElementById("myForm").reset();
     
//     // idValue.classList.remove("error");
//     // fullNameValue.classList.remove("error");


//     // idError.textContent="";
//     // nameError.textContent="";
//     // birthDateError.textContent="";
//     // gpaError.textContent="";
//     // departmentError.textContent="";
//     // batchError.textContent="";
//     // messageError.textContent="";



//     // document.getElementById("universityid").textContent="";
//     // document.getElementById("full_name").textContent="";
//     // document.getElementById("birthError").textContent="";
//     // document.getElementById("cgpaError").textContent="";
//     // document.getElementById("departmentError").textContent="";
//     // document.getElementById('genderError').textContent="";
//     // document.getElementById("batchError").textContent="";
//     // document.getElementById("messageError").textContent="";



// });

function isAbove18(birthDateString) {
    // Parse the birth date string
    var birthDate = new Date(birthDateString);
    
    var today = new Date();
    
    var age = today.getFullYear() - birthDate.getFullYear();
    
    if (today.getMonth() < birthDate.getMonth() || 
        (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    return age >= 18;
}
