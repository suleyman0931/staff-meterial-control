
console.log("hello")
const form=document.getElementById("registrationform");
form.addEventListener("submit",function (event)
{
    let isvalid=true;

var id = document.getElementById("universityid").value;
var name =document.getElementById("fullname").value;
var birth =document.getElementById("birthdate").value;
var gpa = document.getElementById("cgpa").value;
var dep= document.getElementById("department").value;
var gender=document.querySelector('input[name=gender]:checked');
var batch= document.getElementById("batch").value;


var id_error =document.getElementById("id_error");
var name_error =document.getElementById("name_error");
var birth_error =document.getElementById("birth_error");
var cgpa_error =document.getElementById("cgpa_error");
var dep_error =document.getElementById("department_error");
var gender_error=document.getElementById("gender_error");
var batch_error =document.getElementById("batch_error");


//id_input.classList.remove("error");
//name_input.classList.remove("error");

id_error.textContent="";
name_error.textContent="";
birth_error.textContent="";
cgpa_error.textContent="";
dep_error.textContent="";
batch_error.textContent="";
gender_error.textContent="";


   //  display(id,id_error);
     var check=/^WDU\d{6}$/;
if( id ==='')
    {   
        id_error.textContent="Your Id is required ";
    //    name_input.classList.add("error");

        isvalid=false;
    
    }else if( id.length < 6){
        id_error.textContent="Your Id must be 9 character ";
        isvalid=false;
    }

    else if(!check.test(id) )
        {
            id_error.textContent="Id must be start with WDU and the rest must be digit ";
            isvalid=false;

        }

 if( name ==='')
        {   
            name_error.textContent="Full name is required ";
            isvalid=false;
        }

    else if(! /\s/.test(name))
        {
            name_error.textContent=" Space is required between your name ";
            isvalid=false;
        }

if( birth ==='')
        {   
            birth_error.textContent="Birth date  is required ";
            isvalid=false;
        } 
    else if(birth > "2006-12-31"){
        birth_error.textContent="You must greater than 18 ";
            isvalid=false;
    }
       
if( cgpa ==='')
        {   
            cgpa_error.textContent="Your cgpa  is required ";
            isvalid=false;
        }else if(cgpa < 2 || cgpa >4){

            cgpa_error.textContent="Your cgpa  must between 2 and 4 ";
            isvalid=false;
        }

      if(!gender)
          {

         gender_error.textContent=" Your Gender is required ";
         isvalid=false;

         }

    if( batch ==='')
         {   
                batch_error.textContent="Your batch  is required ";
                isvalid=false;
         }else if(batch < 1 || batch >6){

            batch_error.textContent="Your batch  must be between 1 and 6 ";
            isvalid=false;
        }


       if(dep ==='')
           {
            dep_error.textContent="Department is required";

             isvalid=false;
          }else if(dep ==="default"){
            dep_error.textContent="Department is required";

            isvalid=false;
          }
    
        if(isvalid){
          //  console.log("name:",name);


        }
        else{
            event.preventDefault();
        }
});








