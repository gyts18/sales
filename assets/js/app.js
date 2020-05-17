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
    $('#dynamicDiv').hide();
    $('#flowers').click(() => {
        clearViewAndInsertForm(urlFlowers)
    });
    $('#coffee').click(() => {
        clearViewAndInsertForm(urlCoffee)
    });

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
});

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