<div class="c-product-table c-product-table--desktop d-none d-md-block">
  <table>
    <thead>
      <tr>
        <th scope="col"><span class="d-none">Product Image</span></th>

        @foreach ($category->products->getAttributeNames() as $attributeName)
          <th scope="col" data-sort="" class="js-product-table-sortable-column">{{ $attributeName->name }}</th>
        @endforeach

        <th scope="col"><span class="d-none">Email Us About This Product</span></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($category->products as $product)
        <tr>
          <td>
            <div class="c-product-table__img">
              @if ($product->hasMedia('product-thumbnail'))
                <a href="{{ $product->getFirstMediaUrl('product-thumbnail') }}" target="_blank" rel="noopener">
                  <img src="{{ $product->getFirstMediaUrl('product-thumbnail', 'medium') }}" alt="{{ $product->name }} Image">
                </a>
              @else
                <img src="{{ asset('images/placeholder.png') }}" alt="{{ $product->name }} Image">
              @endif
            </div>
          </td>

          @foreach ($product->attributes as $attribute)
            @if ($attribute->value)
              <td>{{ $attribute->value }}</td>
            @else
              <td>-</td>
            @endif
          @endforeach

          <td>
            <div class="c-product-table__email">
              <a href="mailto:support@jmpind.com?subject={{ rawurlencode('JMP Industries Inc. - ' . Auth::user()->company->name . ' is interested in ' . $product->name) }}&body={{ rawurlencode('Company: ' . Auth::user()->company->name) }}%0A{{ rawurlencode('Product: ' . $product->name) }}">
                <div class="c-product-table__email-text">
                  <span>Email us about this product&nbsp;&nbsp;</span><i class="far fa-envelope"></i>
                </div>
                <div class="c-product-table__email-icon">
                  <i class="far fa-envelope"></i>
                </div>
              </a>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="c-product-table c-product-table--mobile d-md-none">
  <table>
    <tbody>
      <tr>
        <th scope="row"></th>

        @foreach ($category->products as $product)
          <td>
            <div class="c-product-table__img">
              @if ($product->hasMedia('product-thumbnail'))
                <a href="{{ $product->getFirstMediaUrl('product-thumbnail') }}" target="_blank" rel="noopener">
                  <img src="{{ $product->getFirstMediaUrl('product-thumbnail', 'thumb') }}" alt="{{ $product->name }} Image">
                </a>
              @else
                <img src="{{ asset('images/placeholder.png') }}" alt="{{ $product->name }} Image">
              @endif
            </div>
          </td>
        @endforeach
      </tr>

      @foreach ($category->products->getAttributeNames() as $attributeName)
          <tr>
            <th scope="row">{{ $attributeName->name }}</th>

            @foreach ($category->products as $product)
              @php
                  $value = $product->attributes->slice($loop->parent->index, 1)->first()->value;
              @endphp

              @if ($value)
                <td>{{ $value }}</td>
              @else
                <td>-</td>
              @endif
            @endforeach
          </tr>
      @endforeach

      <tr>
        <th scope="row"></th>

        @foreach ($category->products as $product)
          <td>
            <a href="mailto:support@jmpind.com?subject={{ rawurlencode('JMP Industries Inc. - ' . Auth::user()->company->name . ' is interested in ' . $product->name) }}&body={{ rawurlencode('Company: ' . Auth::user()->company->name) }}%0A{{ rawurlencode('Product: ' . $product->name) }}">
              Email Us
            </a>
          </td>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>