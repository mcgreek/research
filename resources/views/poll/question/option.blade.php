<div style="text-align: left">
    
    @foreach($choice_data as $choice)
    <div style='padding-top:5px; padding-bottom:5px;'>
        <input type="radio" name="question_{{ $choice->question_id }}" value="{{ $choice->id }}" /> {{ $choice->title }}
    </div>
    @endforeach
    
</div>