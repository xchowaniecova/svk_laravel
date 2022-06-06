<style>
    ol {counter-reset: item;}
    ol li {display: block;}
    ol li:before {content: counter(item) ". "; counter-increment: item; font-weight: bold;}
</style>
<ol class="sortable ui-sortable">
    @foreach ($registration as $r)
    <li class="ui-state-default col-sm-12 ui-sortable-handle col-sm-12" style="margin-bottom:20pt; margin-top:20pt; cursor:move">
        <input type="hidden" name="reg_id[]" value="{{ $r->reg_id }}">
        <strong>{{ $r->name_contribution }}</strong><br>
        {{ $r->surname }}
    </li>
    @endforeach
</ol>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){    
    $('.sortable').sortable({
        revert: true,
        cursor: 'move',
        opacity: 0.7,
    });
    $('ol, li').disableSelection();
});    
</script>    
