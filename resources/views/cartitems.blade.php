@if($newCart != null)
<a href="#" class="close-side"><i class="fa fa-times"></i></a>
<li class="cart-box">
<ul class="cart-list">
  @foreach($newCart->products as $item)
<li>
    <h6>{{$item['productInfo']->name}}</h6>
    <a class="close-cart" style="float:right; cursor:pointer"><i class="fas fa-times" data-id="{{$item['productInfo']->id}}"></i></a>
    <p>x {{$item['quantity']}} - <span class="price">{{number_format($item['productInfo']->price)}}đ</span></p>
</li>
@endforeach
<li class="total">
    <a href="cart" class="btn btn-default hvr-hover btn-cart">GIỎ HÀNG</a>
    <span class="float-right"><strong>Tổng</strong>:{{number_format($newCart->totalPrice)}} đ</span>
</li>
</ul>
</li>
@endif
