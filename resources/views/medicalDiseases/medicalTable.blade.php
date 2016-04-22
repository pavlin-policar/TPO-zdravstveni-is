<div class="dhe-example-section" id="ex-2-1">
    <div class="dhe-example-section-content">

        <!-- BEGIN: XHTML for example 2.1 -->
        <input type="text" />
        <div id="example-2-1">
            <div class="column left first">
                <ul id="result" class="sortable-list">
                    @foreach($goodMedicals as $medical)
                        <li class="sortable-item" id="{{ $medical['id'] }}">{{ $medical->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="column left">
                <ul id="canHide" class="sortable-list">
                    @foreach($allMedicals as $medical)
                        <li class="sortable-item" id="{{ $medical['id'] }}">{{ $medical['name'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="clearer">&nbsp;</div>

        <!-- END: XHTML for example 2.1 -->

    </div>
</div>
{{ Html::script('vendor/js/jquery-1.4.2.min.js') }}
{{ Html::script('vendor/js/jquery-ui-1.8.custom.min.js') }}
<script type="text/javascript">
    $(function(){

        $('input[type="text"]').keyup(function(){

            var searchText = $(this).val().toLowerCase();

            $('#canHide > li').each(function(){

                var currentLiText = $(this).text().toLowerCase(),
                        showCurrentLi = currentLiText.indexOf(searchText) !== -1;

                $(this).toggle(showCurrentLi);

            });
        });

    })
    $(document).ready(function(){
        $('#example-2-1 .sortable-list').sortable({
            connectWith: '#example-2-1 .sortable-list'
        });
        // Example 2.2: Save items
        $('#btn-save').click(function(){
            var niz = "";
            $( "#result > li" ).each(function() {
                niz+=$( this ).attr('id') +",";
            });
            niz=niz.slice(0, -1);
            $('input[name="medicals"]').val(niz);
            //alert(niz);
            $('input[name="medicals"]').parent().submit();
        });

    });

</script>