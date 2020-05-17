const $ = require('jquery');
require('bootstrap');
let urlCoffee = null;
let urlFlowers = null;
document.addEventListener('DOMContentLoaded', () => {
     urlCoffee = $('#coffee').data('url');
     urlFlowers = $('#flowers').data('url');
});
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('#flowers').click(()=>{
       clearViewAndInsertForm(urlFlowers)
    });

    $('#viewDiv').on('click', 'input.form-check-input',()=>{
        if($("#coffee_form_milkType").is(':visible')) {
            $("[for=coffee_form_milkType]").fadeOut()
            $('#coffee_form_milkType').fadeOut();
        }
        else{
            $("[for=coffee_form_milkType]").fadeIn()
            $('#coffee_form_milkType').fadeIn();
        }

    });

});

function clearViewAndInsertForm(url) {
    $('#viewDiv').slideUp("slow",()=>{
        $.getJSON(url, (data)=>{
            let view = $('#viewDiv');
            view.html(data.data);
        }).done(()=>{
            $('#coffee_form_milkType').hide();
            $("[for=coffee_form_milkType]").hide()
            $('#viewDiv').fadeIn();
        });
    });
    $('#title').fadeOut('slow', () => {
        $('#title').text('Please fill out the form').fadeIn();
    });
}

$