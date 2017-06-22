
$( "#tambah_tag" ).click(function() {
    $( "#tag_span" ).append('<span onclick="$(this).remove();refreshtag();" class="label label-success ">'+$( "#input_tag" ).val()+'</span> ');
    $( "#input_tag" ).val('');
    refreshtag();
});

function refreshtag(){
    var container=document.getElementById('tag_span');
    var spanArray=container.getElementsByTagName('span');
    var tag = "";
    for(var s=0;s<spanArray.length;s++){
        tag +=spanArray[s].innerHTML +",";
    }
    $( "#tag" ).val(tag);
}

$(document).ready(function(){
    var result = $( "#tag" ).val().split(',');
    for(var s=0;s<result.length;s++){
        $( "#tag_span" ).append('<span onclick="$(this).remove();refreshtag();" class="label label-success ">'+result[s]+'</span> ');
    }
});
