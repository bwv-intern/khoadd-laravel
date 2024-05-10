<x-layout.app title="Profile">

<div class="container">
    <h1>Lodash test page</h1>
    <h2>List of "things" (capped to 10 on purpose)</h2>
    <ul id="itemList">
    </ul>
    <h2>Control</h2>
    <input type="text" id="itemToPush">
    <button id="pushItem">Push this item</button>
    <button id="popItem">Pop first item</button>
    <button id="reverseList">Reverse list</button>
    @vite(['resources/js/app.js'])
    <script type="module">
        let list = [];
        function redrawList() {
            $("#itemList").first().empty();
            _.forEach(list, function(value, index) {
                $("#itemList").first().append($("<li></li>").text(value));
            })
        }
        $("#pushItem").on("click", function () {
            if (list.length >= 10) {
                return;
            }
            const input = $("#itemToPush").val();
            $("#itemToPush").val("");
            if (_.isEmpty(input)) {
                return;
            }
            list = _.concat(list, input);
            redrawList();
        });
        $("#popItem").on("click", function () {
            let old = list.shift();
            if (_.isEmpty(old)) {
                return;
            }
            $("#itemToPush").val(old);
            redrawList();
        });
        $("#reverseList").on("click", function () {
            _.reverse(list);
            redrawList();
        })
    </script>
</div>

</x-layout.app>
