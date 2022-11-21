<div class="row mt-2 fs-5 mx-0 border-top pb-3">
    <div class="col-6 ">Total Payment</div>
    <div class="col-3 text-end px-0 ">RM</div>
    <div class="col-3 text-end ps-0 ">{{number_format(($total_payment), 2)}}</div>
    <div hidden>
        <input type="number" class="form-control input-md text-center rounded-0 py-1 px-0" readonly
        name="order_total" 
        value="{{number_format(($total_payment), 2)}}">
    </div>
</div>


