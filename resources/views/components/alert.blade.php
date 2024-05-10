<div id="alert">
    @if($errors->any())
    <div class="alert alert-danger">
        <h2>
            {{$errors->first()}}
        </h2>
    </div>
    @endif
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>