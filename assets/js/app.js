const $ = require('jquery');
require('bootstrap');
// initialize urls
let urlCoffee = null;
let urlFlowers = null;
let urlOrders = null;
//

// Get urls from preassigned html
document.addEventListener('DOMContentLoaded', () => {
    urlCoffee = $('#coffee').data('url');
    urlFlowers = $('#flowers').data('url');
    urlOrders = $('#orders').data('url');
});

// Event listeners to clear and update views.
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('#dynamicDiv').hide();
    $('#flowers').click(() => {
        clearViewAndInsertForm(urlFlowers)
    });
    $('#coffee').click(() => {
        clearViewAndInsertForm(urlCoffee)
    });
    $('#orders').click(() => {
        clearViewAndInsertForm(urlOrders)
    });

    //Dynamic generated attributes, cannot be checked with generic jQuery functions
    $('#dynamicDiv').on('click', 'input.form-check-input', () => {
        if ($("#coffee_form_milkType").is(':visible')) {
            $("[for=coffee_form_milkType]").fadeOut()
            $('#coffee_form_milkType').fadeOut();
        } else {
            $("[for=coffee_form_milkType]").fadeIn()
            $('#coffee_form_milkType').fadeIn();
        }

    });
    $('#backButton').click(() => {
        $('#dynamicDiv').fadeOut('slow', () => {
            $('#dynamicDiv').empty();
            $('#viewDiv').fadeIn();
            $('#backButton').attr('hidden', true);
        })
        $('#title').fadeOut('slow', () => {
            $('#title').text('Welcome to the "CMS" system').fadeIn();
        });
        $('#backButton').fadeOut();
    })

    let modal = $('.modal');
    if (modal.length) {
        modal.modal('show');
    }
});
//Clear view and insert other contents
function clearViewAndInsertForm(url) {
    $('#viewDiv').slideUp("slow", () => {
        $.getJSON(url, (data) => {
            let view = $('#dynamicDiv');
            view.html(data.data);
        }).done(() => {
            $('#coffee_form_milkType').hide();
            $("[for=coffee_form_milkType]").hide()
            $('#viewDiv').fadeOut();
            $('#dynamicDiv').fadeIn();
        });
    });
    $('#title').fadeOut('slow', () => {
        $('#title').text('Please fill out the form').fadeIn();
        $('#backButton').attr('hidden', false).fadeIn();
    });
}

$