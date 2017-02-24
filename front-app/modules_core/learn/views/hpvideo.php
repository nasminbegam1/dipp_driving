<div class="container">
<article class="vidIn">
    
    <div id="show_video" data-review="0"></div>
    
<div id="show_video_group">
    <div class="hazard-perception clearfix">
    <h4>Hazard Perception Videos</h4>
    <a href="<?php echo base_url().'learn'; ?>">Learning zone</a>
    </div>
 
 <div class="steps">
<ul>
    <li>Step 1 : Watch the DVSA introduction video</li>
    <li>Step 2 : Select a video group
        <select id="video_select">
             <option value="intro_video">DVSA introduction video</option>
             <option value="0">CGI Videos 1-10</option>
             <option value="10">DVSA Videos 11-20</option>
             <option value="20">DVSA Videos 21-26</option>
        </select>
    </li> 
    <li>Step 3: Select a Video from the list below:</li> 
</ul>
</div>   


<div class="video_name_html clearfix"></div>
<div class="btm"></div>
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
                video_name_html += '<ul>';
                //Introduction view
                if (data.video == 'introduction') {
                    video_name_html += '<li class="clearfix introVid">';
                    video_name_html += '<div class="vidLeft">';
                    video_name_html += '<div class="vidNme">';
                    video_name_html += 'DVSA introduction ';
                    video_name_html += '</div>';
                    video_name_html += '<div class="view_video" id="introvideo">View DVSA introduction </div>';
                    video_name_html += '</div>';
                    
                    video_name_html += '<div class="vidRight">';
                    video_name_html += '<img src="<?php echo base_url();?>images/video-img/intro.jpg">';
                    video_name_html += '</div>';
                }
                else{
                    //Other video
                $.each(data.video, function( index, value ) {
                    video_name_html += '<li class="clearfix">';
                    video_name_html += '<div class="vidLeft">';
                    video_name_html += '<div class="vidNme">';
                    video_name_html += 'Video '+value.id;
                    video_name_html += '</div>';
                    if(typeof value.result != "undefined"){
                        if (value.result.score >= 4) {
                            video_name_html += '<div class="scr Grn">Your last score : '+value.result.score+' out of 5</div>';
                        }else if (value.result.score > 4 && value.result.score < 2) {
                            video_name_html += '<div class="scr Ylw">Your last score : '+value.result.score+'  out of 5</div>';
                        }else{
                            video_name_html += '<div class="scr active">Your last score : '+value.result.score+'  out of 5</div>';
                        }
                        
                    }else{
                        video_name_html += '<div class="scr">Your last score : None</div>';
                    }
                    video_name_html += '<div class="view_video" id="'+value.id+'">Take test </div>';
                    /*video_name_html += '<div class="video-review" id="'+value.id+'">Answer </div>';*/
                    video_name_html += '</div>';
                    
                    video_name_html += '<div class="vidRight">';
                    video_name_html += '<img src="<?php echo base_url();?>images/video-img/vid'+value.id+'.jpg">';
                    video_name_html += '</div>';
                    
                    video_name_html += '</li>';
                });
                }
                video_name_html += '</ul>';
                $('.video_name_html').html(video_name_html);
                
                $(".video-review").click(function(){
                  $(this).parent().find('.view_video').click();
                  $('#show_video').attr('data-review',1);
                })
                $('.view_video').on('click',function(){
                    var id = $(this).attr('id');
                    $.ajax({
                        type: 'post',
                        data: 'id='+id,
                        beforeSend: function( ) {
                        },
                        url: _baseUrl + 'learn/view_video',
                        success: function(data){
                            console.log(data);
                            $('#show_video_group').hide();
                            $('#show_video').html(data);
                            if ($('#show_video').attr('data-review') == '1') {
                                $('.video-overlay').hide();
                                $('#show_video').find('.video-review').trigger('click');
                                $('#show_video').attr('data-review','0');
                            }
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