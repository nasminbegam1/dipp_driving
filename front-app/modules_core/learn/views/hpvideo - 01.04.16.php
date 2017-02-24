<div class="container">
<article>
    <div id="show_video"></div>
<div id="show_video_group">
    <div class="hazard-perception">
    <h4>Hazard Perception Videos</h4>
    <a href="">Learning zone</a>
    </div>
Step 1 : Select a video group
<select id="video_select">
    <option value="0">Videos 1-10</option>
    <option value="10">Videos 11-20</option>
    <option value="20">Videos 21-26</option>
</select>
<div class="video_name_html"></div>
</div>
<script>
    $('#video_select').change(function(){
        var start_val = $(this).val();
        $.ajax({
            type: 'post',
            data: 'start_val='+start_val,
            dataType : 'JSON',
            beforeSend: function( ) {
            },
            url: _baseUrl + 'learn/get_video_list',
            success: function(data){
                var video_name_html = '';
                $.each(data.video, function( index, value ) {
                    video_name_html += 'Video '+value.id;
                    video_name_html += '<div class="view_video" id="'+value.id+'">Take test </div>';
                    video_name_html += '<div>';
                    if(typeof value.result != "undefined"){
                        video_name_html += 'Your last score : '+value.result.score;
                    }else{
                        video_name_html += 'Your last score : None';
                    }
                    video_name_html += '</div>';
                });
                $('.video_name_html').html(video_name_html);
                
                $('.view_video').on('click',function(){
                    var id = $(this).attr('id');
                    $.ajax({
                        type: 'post',
                        data: 'id='+id,
                        beforeSend: function( ) {
                        },
                        url: _baseUrl + 'learn/view_video',
                        success: function(data){
                            $('#show_video_group').hide();
                            $('#show_video').html(data);
                            
                            $('#back_to_video').on('click',function(){
                                $('#video_select').trigger('change');
                                $('#show_video_group').show();
                                $('#show_video').empty();
                            });
                        }
                    });
                });
            }
        });
    });
    $('#video_select').trigger('change');
    
</script>
</article>
</div>