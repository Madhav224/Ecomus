<div class="my_datatable">
    <div class="card-datatable table-responsive pt-0 my_datatable2">
        <table class="user-list-table table ">
            <thead class="table-light">
                <tr>
                    @foreach ($thead as $th)
                    @php
                    $sortColumn = request()->get('sort');
                    $sortDirection = request()->get('direction', 'asc');
                    $isSorted = $sortColumn == $th['col'];
                    $iconClass = $isSorted ? ($sortDirection == 'asc' ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort';
                    @endphp
                    <th class="text-nowrap text-center {{ $th['is_sort'] ? ' order_by' : '' }}"
                        data-column="{{ $th['col'] }}">
                        <a href="javascript:void(0);" class="{{ $th['is_sort'] ? 'sortable' : '' }} text-dark">
                            {!! $th['title'] !!}
                            @if ($th['is_sort'])
                            <i class="fa {{ $iconClass }} sort-icon"></i>
                            @endif
                        </a>
                    </th>
                    @endforeach
                </tr>

            </thead>
            <tbody>
                @if (!$tbody->isEmpty())
                @foreach ($tbody as $tbody_value)
                <tr>
                    @foreach ($tbody_value as $tbody_tr_value)
                    <td class="text-nowrap text-center ">{!! $tbody_tr_value !!}</td>
                    @endforeach
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="{{ count($thead) }}">No Data Found</td>
                    <script>$(".datatable_allcheckbox").attr("disabled",true)</script>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    {{-- pagination --}}
    <div class="justify-content-end mt-1 mx-2">
        {{ $tbody->links() }}
    </div>
    {!! (isset($MyWatchScript)?'<script>
    getLPrice('.json_encode($MyWatchScript, 15, 512).')
    </script>':'') !!}

</div>
