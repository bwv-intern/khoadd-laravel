<x-layout.app title="Validator">

<div class="container">
    <h1>Validation testing page</h1>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <form class="cmxform" id="validatorForm" method="POST" action="{{route('validatorSubmit')}}">
        @csrf
        <fieldset>
          <legend>Please fill in this form below.</legend>
          <p>
            <label for="shortName">Short name (required, at most 5 characters, ascii characters only)</label>
            <input type="text" id="shortName" name="shortName" value="{{old('shortName')}}">
          </p>
          <p>
            <label for="longName">Long name (required, at least 10 characters, ascii characters only)</label>
            <input type="text" id="longName" name="longName" value="{{old('longName')}}">
          </p>
          <p>
            <label for="anyString">Any string (required, between 5 and 20 characters, ascii alphanumerics only)</label>
            <input id="anyString" type="text" name="anyString" value="{{old('anyString')}}">
          </p>
          <p>
            <label for="url">URL (required, must resemble a URL)</label>
            <input id="url" type="url" name="url" value="{{old('url')}}">
          </p>
          <p>
            <label for="spellcard">Spellcard (required, at most 50 characters, must contain "Sign", ascii alphanumerics only)</label>
            <input id="spellcard" type="text" name="spellcard" value="{{old('spellcard')}}">
          </p>
          <p>
            <label for="phone">VN Phone number (required, exactly 9 characters (no region code), digits only)</label>
            <input id="phone" type="tel" name="phone" value="{{old('phone')}}">
          </p>
          <p>
            <label for="email">Email (required, must resemble an email address)</label>
            <input id="email" type="email" name="email" value="{{old('email')}}">
          </p>
          <p>
            <label for="age">Age (must be 18 or greater, digits only)</label>
            <input id="age" type="number" name="age" value="{{old('age')}}">
          </p>
          <p>
            <label for="dateOfBirth">Date of birth (must be before the year 2000)</label>
            <input id="dateOfBirth" type="date" name="dateOfBirth" value="{{old('dateOfBirth')}}">
          </p>
          <p>
            <label for="skipClientValidation"> Skip client-side validation</label>
            <input id="skipClientValidation" type="checkbox" name="skipClientValidation" {{old('skipClientValidation') == 'on'? 'checked' : ''}}>
          </p>          
          <p>
            <button class="btn btn-primary" type="submit">Submit</button>
          </p>
        </fieldset>
      </form>
      <script>
        jQuery.validator.addMethod("lettersonlynd", function(value, elm) {
            return this.optional(elm) || /^[a-z]+$/i.test(value);
        }, "Please only use ascii letters.");
        jQuery.validator.addMethod("alphanumericnd", function(value, elm) {
            return this.optional(elm) || /^[a-z0-9]+$/i.test(value);
        }, "Please only use ascii letters and numbers.");
        jQuery.validator.addMethod("isSpellcard", function(value, elm) {
            return this.optional(elm) || /^.*Sign.*$/.test(value);
        }, "Please include \"Sign\".");
        jQuery.validator.addMethod("isVNPhone", function(value, elm) {
            return this.optional(elm) || /^[1-9][0-9]{8}$/.test(value);
        }, "Please provide a VN phone number.");
        jQuery.validator.addMethod("dateBefore2000", function(value, elm) {
            return this.optional(elm) || (Date.parse("01 Jan 2000") > new Date(value));
        }, "Please provide a time before the year 2000.");
        $("#skipClientValidation").on("change", function () {
          if ($("#skipClientValidation").prop('checked')) {
            $("#validatorForm").validate().settings.ignore = "*";
          }
          else {
            $("#validatorForm").validate().settings.ignore = ":hidden";
          }
        })
        $("#validatorForm").validate(
        {
            ignore: $("#skipClientValidation").prop('checked')? "*" : ":hidden",
            rules: {
                shortName: {
                    required: true,
                    requiredHard: true,
                    lettersonlynd: true,
                    maxlength: 5,
                },
                longName: {
                    required: true,
                    requiredHard: true,
                    lettersonlynd: true,
                    minlength: 10
                },
                anyString: {
                    required: true,
                    requiredHard: true,
                    minlength: 5,
                    maxlength: 20,
                },
                url: {
                    required: true,
                    requiredHard: true,
                    url: true,
                },
                spellcard: {
                    required: true,
                    requiredHard: true,
                    maxlength: 50,
                    isSpellcard: true,
                },
                phone: {
                    required: true,
                    requiredHard: true,
                    digits: true,
                    isVNPhone: true,
                },
                age: {
                    required: true,
                    requiredHard: true,
                    digits: true,
                    min: 18,
                },
                dateOfBirth: {
                    required: true,
                    requiredHard: true,
                    dateISO: true,
                    dateBefore2000: true,
                }
            },
        }
      );
      </script>
</div>

</x-layout.app>
