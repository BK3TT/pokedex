$(document).ready(function(){
    $(document).on("click", "div.abilitiesBtn", function(){
        $(this).parent().parent().parent().parent().find("div.abilities").show();
    });
    $(document).on("click", "div.typesBtn", function(){
        $(this).parent().parent().parent().parent().find("div.types").show();
    });
    $(document).on("click", "div.abilities, div.types", function(){
        $(this).hide();
    });
});