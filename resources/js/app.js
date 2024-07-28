require('./bootstrap');

$(document).on('input', '.auto-caps', function(e){
    let start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    return e.target.setSelectionRange(start, start);
})