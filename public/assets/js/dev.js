$( document ).ready(function() {
    $(".disabled").attr('readonly', true);
});

function openSolution() {
    $(".disabled").attr('readonly', false);
   
}
