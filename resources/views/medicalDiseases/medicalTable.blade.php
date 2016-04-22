<div class="dhe-example-section" id="ex-2-1">
    <div class="dhe-example-section-content">

        <!-- BEGIN: XHTML for example 2.1 -->
        <input type="text" />
        <div id="example-2-1">
            <div class="column left first">
                <ul class="sortable-list">
                    @foreach($goodMedicals as $medical)
                        <li class="sortable-item" id="{{ $medical->id }}">{{ $medical->name }}</li>
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

        // Get items
        function getItems(exampleNr)
        {
            var columns = [];

            $(exampleNr + ' ul.sortable-list').each(function(){
                columns.push($(this).sortable('toArray').join(','));
            });

            return columns.join('|');
        }

        // Render items
        function renderItems(items)
        {
            var html = '';

            var columns = items.split('|');

            for ( var c in columns )
            {
                html += '<div class="column left';

                if ( c == 0 )
                {
                    html += ' first';
                }

                html += '"><ul class="sortable-list">';

                if ( columns[c] != '' )
                {
                    var items = columns[c].split(',');

                    for ( var i in items )
                    {
                        html += '<li class="sortable-item" id="' + items[i] + '">Sortable item ' + items[i] + '</li>';
                    }
                }

                html += '</ul></div>';
            }

            $('#example-2-4-renderarea').html(html);
        }

        // Example 2.1: Get items
        $('#example-2-1 .sortable-list').sortable({
            connectWith: '#example-2-1 .sortable-list'
        });

        // Example 2.2: Save items
        $('#btn-save').click(function(){
            $.cookie('cookie-a', getItems('#example-2-1'));

            alert('Items saved (' + $.cookie('cookie-a') + ')');
        });

    });

</script>