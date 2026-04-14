 document.getElementById("registration").addEventListener("submit",function (event){

    let isValid=true;

        var depId = document.getElementById("departmentId").value;
        var depCode =document.getElementById("departmentCode").value;
        var depName =document.getElementById("departmentName").value;
        var depLocation = document.getElementById("departmentLocation").value;

        var idError =document.getElementById("idError");
        var codeError =document.getElementById("codeError");
        var nameError =document.getElementById("nameError");
        var locationError =document.getElementById("locationError");

        idError.textContent="";
        nameError.textContent="";
        codeError.textContent="";
        locationError.textContent="";

            //id validation
        if( depId ===''){   
            idError.textContent="Id is required";
            isValid=false;

        }else if( depId.length < 4 || depId.length > 6){
            idError.textContent="id must be between  4 and 6 character";
            isValid=false;
        }
        // name validation
        if( depName ===''){   
            nameError.textContent="department name is required";
            isValid=false;
        }
        // code validation
        if( depCode ===''){   
            codeError.textContent="department code is required";
            isValid=false;
        } 

        // location validation
        if( depLocation ===''){   
            locationError.textContent="location is required";
            isValid=false;
        }
    
        if(isValid){
           console.log("successFull");
        }else{
            event.preventDefault();
        }
    });








