<table class="table table-striped table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        <th>Tên Widget</th>
        <th>Từ khóa</th>
        <th>Short_code</th>
        @include('backend.dashboard.component.languageTh')
        <th class="text-center">Tình Trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($promotions) && is_object($promotions))
            @foreach($promotions as $promotion)
            <tr >
                <td>
                    <input type="checkbox" value="{{ $promotion->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    {{ $promotion -> name }}
                </td>
                <td>
                  {{ $promotion -> keyword }}
                </td>
                <td>
                   {{ ($promotion->short_code) ?? '-' }}
                </td>
                <td  class="text-center"> 
                    <a href="#">Chưa dịch</a>
                </td>
                <td class="text-center js-switch-{{ $promotion->id }}"> 
                    <input type="checkbox" value="{{ $promotion->publish }}" class="js-switch status " data-field="publish" data-model="{{ $config['model'] }}" {{ ($promotion->publish == 2) ? 'checked' : '' }} data-modelId="{{ $promotion->id }}" />
                </td>
                <td class="text-center"> 
                    <a href="{{ route('promotion.edit', $promotion->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('promotion.delete', $promotion->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{  $promotions->links('pagination::bootstrap-4') }}
