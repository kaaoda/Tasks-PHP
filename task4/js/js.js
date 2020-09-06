/*global $, alert, console*/ 
var errors = {};
function createAlert(element,msg=null)
{
    if(msg != null)
        element.parent().find('.my-alert').text(msg);
    element.parent().find('.my-alert').fadeIn(300);
    element.parent().find('i').css("color","#dc3545");
    element.css("border","1px solid #dc3545");
    element.css("color","#dc3545");
    errors[element.selector] = true;
}

function createSuccess(element)
{
    $(element).parent().find('.my-alert').fadeOut(300);
    $(element).css("border","1px solid #28a745");
    $(element).parent().find('i').css("color","#28a745");
    $(element).css("color","#28a745");
    $(element).css("font-weight","bold"); 
    errors[element.selector] = false;
}

function checkEmpty(element)
{
    if($(element).val() == "")
        return true;
    else
        return false;
}

function getValue(element)
{
    return $(element).val();
}


function checkSubmit(event)
{
    for(var error in errors)
    {
        if(errors[error] == true)
        {
            event.preventDefault();
            $('.submit-btn').parent().find('.my-alert').show();
            return false;
        }
            
    }
    $('.submit-btn').parent().find('.my-alert').attr("class","alert alert-success my-alert");
    $('.submit-btn').parent().find('.my-alert').text("All Done");
}


function processInput(element,name)
{
    var empty = checkEmpty(element);
    var value = getValue(element);
    switch(name)
    {
        
        case "password":
        {
            if(!empty && value.length < 8)
                createAlert(element,"Password must not less than 8 letters");
            else if(empty)
                createAlert(element);
            else
                createSuccess(element);
            break;
        }

        case "phone":
        {
            if(!empty && isNaN(value))
                createAlert(element,"Phone Number must be digits only");
            else if(empty)
                createAlert(element);
            else
                createSuccess(element);
            break;
        }

        default:
             if(empty)
                createAlert(element);
            else
                createSuccess(element);
    }
    
}

$(document).ready(function(){

    var inputs = $(':input');
    for(var input of inputs)
    {
        if(input.id == "submit") continue;
        errors["#"+input.id] = true;
    }
    
    

    $("input:not([id='submit'])").blur(function(){
        processInput($("#"+this.id),$(this).attr('name'));
        
    });

    $(".signup-form").submit(function(event){
        checkSubmit(event);
    });

});