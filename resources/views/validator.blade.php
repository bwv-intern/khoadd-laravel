<x-layout.app title="Validator"></x-layout.app>
@section('content')

<div class="container">
    <h1>Validation testing page</h1>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <form class="cmxform" id="validatorForm" method="POST" action="{{route('validator')}}">
        <fieldset>
          <legend>Please fill in this form below.</legend>
          <p>
            <label for="shortName">Short name (required, at most 5 characters, characters only)</label>
            <input type="text" id="shortName" name="shortName">
          </p>
          <p>
            <label for="longName">Long name (required, at least 10 characters, characters only)</label>
            <input type="text" id="longName" name="longName">
        </p>
          <p>
            <label for="anyString">Any string (required, between 5 and 20 characters, alphanumerics only)</label>
            <input id="anyString" type="text" name="anyString">
          </p>
          <p>
            <label for="url">URL (required, must resemble a URL)</label>
            <input id="url" type="url" name="url">
          </p>
          <p>
            <label for="spellcard">Spellcard (required, at most 50 characters, must contain "Sign", alphanumerics only)</label>
            <input id="spellcard" type="text" name="spellcard">
          </p>
          <p>
            <label for="phone">Phone number (required, exactly 10 characters, digits only)</label>
            <input id="phone" type="tel" name="phone">
          </p>
          <p>
            <label for="email">Email (required, must resemble an email address)</label>
            <input id="email" type="email" name="email">
          </p>
          <p>
            <label for="age">Age (must be 18 or greater, digits only)</label>
            <input id="age" type="number" name="email">
          </p>
          <p>
            <label for="dateOfBirth">Date of birth (must be before the year 2000)</label>
            <input id="age" type="number" name="email">
          </p>
          <p>
            <label for="skipClientValidation"> Skip client-side validation</label>
            <input id="skipClientValidation" type="checkbox" name="skipClientValidation">
          </p>          
          <p>
            <button class="btn btn-primary" type="submit">Submit</button>
          </p>
        </fieldset>
      </form>
      <script>
        jQuery.validator.addMethod("isSpellcard", function(value, elm) {
            return this.optional(elm) || /^.*Sign.*/.test(value);
        }, "Must contain \"Sign\". Please refer to any Touhou spellcard with \"Sign\".")
      $("#validatorForm").validate(
        {
            // debug: !$('#skipClientValidation').checked,
            rules: {
                shortName: {
                    required: true,
                    lettersonly: true,
                    maxlength: 5,
                },
                longName: {
                    required: true,
                    lettersonly: true,
                    minlength: 10
                },
                anyString: {
                    required: true,
                    lettersonly: true,
                    minlength: 5,
                    maxlength: 20,
                    alphanumeric: true,
                },
                url: {
                    required: true,
                    url: true,
                },
                spellcard: {
                    required: true,
                    // maxlengh: 50,
                    isSpellcard: true,
                }
            },
        }
      );
      </script>
</div>
