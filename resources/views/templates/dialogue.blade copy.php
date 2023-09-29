<style>
.grayscale {
  -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);
}
</style>

@php 
    $dialogue = $data["dialogue"];
    $characters = $data["characters"];
    $id = $tag->id;
@endphp

<!---Version: show all chars at the top of box and highlight the speaker--->
<div class="row">
    @foreach($characters as $name => $images)
    <div class="col-lg col-6 justify-content-center d-flex align-items-end" id="{{ $name }}-image-container">
        <img src="{{ $images[0]}}" class="rounded grayscale" style="max-width:100%;">
    </div>
    @endforeach
</div>
<div class="border rounded mt-1">
    @foreach($dialogue as $dialogueStep)
    <div class="{{ ($loop->index == 0) ? '' : 'hide' }} dialogue" id="dialogue-{{$loop->index}}">
        <img src="{{ $dialogueStep['image']}}" class="rounded hide" style="max-width:100%;" id="{{ $dialogueStep['name'] }}-image">
        <div class="bg-light ml-2 p-0"><h4 id="speaker-{{$loop->index}}">{{ $dialogueStep['name']}}</h4></div>
        <div class="p-4">{{ $dialogueStep['text']}}</div>
    </div>
    @endforeach
    <div class="bg-light ">
        <div id="previous-button" class="btn btn-primary disabled"><i class="fa fa-chevron-left"></i></div>
        <div id="next-button" class="btn btn-primary float-right"><i class="fa fa-chevron-right"></i></div>
    </div>
</div>



<script>

    $( document ).ready(function() {
        var step = 0;
        var dialogueSteps = $(".dialogue").length;
        console.log('{{ $id }}');
        updateSpeaker();


        $('#next-button').on('click', function(e) {
            if(!$('#next-button').hasClass('disabled')){
                var currentDialogue = document.getElementById('dialogue-' + step);
                step += 1;
                var nextDialogue = document.getElementById('dialogue-' + step);
                currentDialogue.classList.add('hide');
                nextDialogue.classList.remove('hide');
                $('#previous-button').removeClass('disabled');
                if(step + 1 >= dialogueSteps) $('#next-button').addClass('disabled');
                updateSpeaker();
            }
        });

        $('#previous-button').on('click', function(e) {
            if(!$('#previous-button').hasClass('disabled')){
                var currentDialogue = document.getElementById('dialogue-' + step);
                step -= 1;
                var previousDialogue = document.getElementById('dialogue-' + step);
                currentDialogue.classList.add('hide');
                previousDialogue.classList.remove('hide');
                if(step <= 0) $('#previous-button').addClass('disabled');
                $('#next-button').removeClass('disabled');
                updateSpeaker();
            }
        });

        function updateSpeaker(){
            var prevSpeaker = document.getElementById('speaker-' + (step - 1));
            if(prevSpeaker != null) $('#' + prevSpeaker.innerHTML + '-image').addClass('grayscale');
 
            var nextSpeaker = document.getElementById('speaker-' + (step + 1));
            if(nextSpeaker != null) $('#' + nextSpeaker.innerHTML + '-image').addClass('grayscale');

            var speaker = document.getElementById('speaker-' + step).innerHTML;

            var imageContainer =  $('#' + speaker + '-image-container');
            var replacementImg = $('#' + speaker + '-image').clone();
            replacementImg.removeClass('hide');
            replacementImg.removeClass('grayscale');
            imageContainer.empty();
            imageContainer.append(replacementImg);
        }
    });


</script>