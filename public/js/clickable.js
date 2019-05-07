$('.clickable').click(function(e){
    $(this).children('input').prop('checked', true);
})

$('.selectionnable').click(function(e){
    $(this).children('input').prop('checked', !$(this).children('input').prop('checked'));
})

$('.selectionnable>input').click(function(e){
    e.stopPropagation();
})