<!-- Fillter By Price -->
<form action="{{ request()->fullUrlWithQuery(['id'=>request()->id]) }}">
<input type="hidden" name="id" value="{{ request()->id ?? 0 }}" />
    <div class="sidebar-widget price_range range mb-10">
        <div class="widget-header position-relative mb-20 pb-10">
            <h5 class="widget-title  style-1 wow fadeIn animated animated animated mb-10">Fill by price</h5>
            <div class="bt-1 border-color-1"></div>
        </div>
        <div class="price-filter">
            <div class="price-filter-inner">
                <div id="slider-range"></div>
                <div class="price_slider_amount">
                    <div class="label-input">
                        <span>Range:</span>
                        <input type="text" id="amount_price" readonly placeholder="Add Your Price" />
                        <input type="hidden" id="min_price" name="min" value="{{ request()->min ?? 500 }}" />
                        <input type="hidden" id="max_price" name="max" value="{{ request()->max ?? 3000 }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-category mb-10">
        <div class="shop-filter-toogle filter-toogle-color">
            <div class="row ">
                <div class="col-md-10 col-sm-10 pointer">
                    <h5 class="section-title style-1 wow fadeIn animated animated animated " style="visibility: visible;">
                        Color
                    </h5>
                </div>
                <div class="col-md-2 col-sm-2 pointer">
                    <i class="fi-rs-angle-small-down angle-down"></i>
                    <i class="fi-rs-angle-small-up angle-up"></i>
                </div>
            </div>
        </div>
        <div class="custome-checkbox shop-product-fillter-header filter-color mt-10">
            <input class="form-check-input" type="checkbox" name="color[]" id="color_silver" value="Silver" {{ (isset(request()->color) && in_array('Silver',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_silver"><span>Silver</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_space_grey" value="Locked" {{ (isset(request()->color) && in_array('Space Grey',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_space_grey"><span>Space Grey</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_gold" value="Gold" {{ (isset(request()->color) && in_array('Gold',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_gold"><span>Gold</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_rose_gold" value="Rose Gold" {{ (isset(request()->color) && in_array('Rose Gold',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_rose_gold"><span>Rose Gold</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_product_red" value="Product Red" {{ (isset(request()->color) && in_array('Product Red',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_product_red"><span>Product Red</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_yellow" value="Yellow" {{ (isset(request()->color) && in_array('Yellow',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_yellow"><span>Yellow</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_white" value="White" {{ (isset(request()->color) && in_array('White',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_white"><span>White</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_coral" value="Coral" {{ (isset(request()->color) && in_array('Coral',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_coral"><span>Coral</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_black" value="Black" {{ (isset(request()->color) && in_array('Black',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="exampleCheckbox1221"><span>Black</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_blue" value="Blue" {{ (isset(request()->color) && in_array('Blue',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_blue"><span>Blue</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_purple" value="Purple" {{ (isset(request()->color) && in_array('Purple',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_purple"><span>Purple</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_green" value="Green" {{ (isset(request()->color) && in_array('Green',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_green"><span>Green</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_midnight_green" value="Midnight Green" {{ (isset(request()->color) && in_array('Midnight Green',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_midnight_green"><span>Midnight Green</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_pacific_blue" value="Pacific Blue" {{ (isset(request()->color) && in_array('Pacific Blue',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_pacific_blue"><span>Pacific Blue</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_graphite" value="Graphite" {{ (isset(request()->color) && in_array('Graphite',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_graphite"><span>Graphite</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_pink" value="Pink" {{ (isset(request()->color) && in_array('Pink',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_pink"><span>Pink</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_starlight" value="Starlight" {{ (isset(request()->color) && in_array('Starlight',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_starlight"><span>Starlight</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_sierra_blue" value="Sierra Blue" {{ (isset(request()->color) && in_array('Sierra Blue',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_sierra_blue"><span>Sierra Blue</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="color[]" id="color_deep_purple" value="Deep Purple" {{ (isset(request()->color) && in_array('Deep Purple',request()->color))?'checked':'' }}>
            <label class="form-check-label" for="color_deep_purple"><span>Deep Purple</span></label>
        </div>
    </div>
    <div class="widget-category mb-10">
        <div class="shop-filter-toogle  filter-toogle-carrier">
            <div class="row ">
                <div class="col-md-10 col-sm-10 pointer">
                    <h5 class="section-title style-1 wow fadeIn animated animated animated " style="visibility: visible;">
                        Carrier
                    </h5>
                </div>
                <div class="col-md-2 col-sm-2 pointer">
                    <i class="fi-rs-angle-small-down angle-down"></i>
                    <i class="fi-rs-angle-small-up angle-up"></i>
                </div>
            </div>
        </div>
        <div class="custome-checkbox shop-product-fillter-header filter-carrier mt-10">
            <input class="form-check-input" type="checkbox" name="carrier[]"  id="carrier_Locked" value="Locked" {{ (isset(request()->carrier) && in_array('Locked',request()->carrier))?'checked':'' }}>
            <label class="form-check-label" for="carrier_Locked"><span>Locked</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="carrier[]" id="carrier_Unlocked" value="Unlocked" {{ (isset(request()->carrier) && in_array('Unlocked',request()->carrier))?'checked':'' }}>
            <label class="form-check-label" for="carrier_Unlocked"><span>Unlocked</span></label>
        </div>
    </div>
    <div class="widget-category mb-10">
        <div class="shop-filter-toogle filter-toogle-condition">
            <div class="row ">
                <div class="col-md-10 col-sm-10 pointer">
                    <h5 class="section-title style-1 wow fadeIn animated animated animated " style="visibility: visible;">
                        Condition
                    </h5>
                </div>
                <div class="col-md-2 col-sm-2 pointer">
                    <i class="fi-rs-angle-small-down angle-down"></i>
                    <i class="fi-rs-angle-small-up angle-up"></i>
                </div>
            </div>
        </div>
        <div class="custome-checkbox shop-product-fillter-header filter-condition mt-10">
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_New_seal_pack" value="New seal pack" {{ (isset(request()->condition) && in_array('New seal pack',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_New_seal_pack"><span>New Seal Pack</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_New_non_active" value="New non active" {{ (isset(request()->condition) && in_array('New non active',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_New_non_active"><span>New Non Active</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_New_active" value="New active" {{ (isset(request()->condition) && in_array('New active',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_New_active"><span>New Active</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_Refurbished" value="Refurbished" {{ (isset(request()->condition) && in_array('Refurbished',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_Refurbished"><span>Refurbished</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_Excellent_condition" value="Excellent condition" {{ (isset(request()->condition) && in_array('Excellent condition',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_Excellent_condition"><span>Excellent Condition</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_pristine_condition" value="pristine condition" {{ (isset(request()->condition) && in_array('Pristine condition',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_pristine_condition"><span>Pristine Condition</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_Original_condition" value="Original condition" {{ (isset(request()->condition) && in_array('Original condition',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_Original_condition"><span>Original Condition</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_Used_condition" value="Used condition" {{ (isset(request()->condition) && in_array('Used condition',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_Used_condition"><span>Used Condition</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="condition[]"  id="condition_unlock" value="Used condition" {{ (isset(request()->condition) && in_array('Unlock',request()->condition))?'checked':'' }}>
            <label class="form-check-label" for="condition_unlock"><span>Unlock</span></label>
        </div>
    </div>
    <div class="widget-category mb-10">
        <div class="shop-filter-toogle  filter-toogle-memory">
            <div class="row ">
                <div class="col-md-10 col-sm-10 pointer">
                    <h5 class="section-title style-1 wow fadeIn animated animated animated " style="visibility: visible;">
                        Memory
                    </h5>
                </div>
                <div class="col-md-2 col-sm-2 pointer">
                    <i class="fi-rs-angle-small-down angle-down"></i>
                    <i class="fi-rs-angle-small-up angle-up"></i>
                </div>
            </div>
        </div>
        <div class="custome-checkbox shop-product-fillter-header filter-memory mt-10">
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_4_gb" value="4GB" {{ (isset(request()->memory) && in_array('4GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_4_gb"><span>4 GB</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_8_gb" value="8GB" {{ (isset(request()->memory) && in_array('8GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_8_gb"><span>8 GB</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_16_gb" value="16GB" {{ (isset(request()->memory) && in_array('16GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_16_gb"><span>16 GB</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_32_gb" value="32GB" {{ (isset(request()->memory) && in_array('32GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_32_gb"><span>32 GB</span></label>
             <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_64_gb" value="64GB" {{ (isset(request()->memory) && in_array('64GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_64_gb"><span>64 GB</span></label>
             <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_128_gb" value="128GB" {{ (isset(request()->memory) && in_array('128GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_128_gb"><span>128 GB</span></label>
             <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_256_gb" value="256GB" {{ (isset(request()->memory) && in_array('256GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_256_gb"><span>256 GB</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="memory[]" id="memory_512_gb" value="512GB" {{ (isset(request()->memory) && in_array('512GB',request()->memory))?'checked':'' }}>
            <label class="form-check-label" for="memory_512_gb"><span>512 GB</span></label>
        </div>
    </div>
    <div class="widget-category mb-10">
        <div class="shop-filter-toogle filter-toogle-grade">
            <div class="row ">
                <div class="col-md-10 col-sm-10 pointer">
                    <h5 class="section-title style-1 wow fadeIn animated animated animated " style="visibility: visible;">
                        Grade
                    </h5>
                </div>
                <div class="col-md-2 col-sm-2 pointer">
                    <i class="fi-rs-angle-small-down angle-down"></i>
                    <i class="fi-rs-angle-small-up angle-up"></i>
                </div>
            </div>
        </div>
        <div class="custome-checkbox shop-product-fillter-header filter-grade mt-10">
            <input class="form-check-input" type="checkbox" name="grade[]"  id="grade_a11" value="A++" {{ (isset(request()->grade) && in_array('A++',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_a11"><span>Grade A++</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]"  id="grade_1" value="A+" {{ (isset(request()->grade) && in_array('A+',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_1"><span>Grade A+</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]"  id="grade_a" value="A" {{ (isset(request()->grade) && in_array('A',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_a"><span>Grade A</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]" id="grade_b" value="B" {{ (isset(request()->grade) && in_array('B',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_b"><span>Grade B</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]" id="grade_c" value="C" {{ (isset(request()->grade) && in_array('C',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_c"><span>Grade C</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]" id="grade_d" value="D" {{ (isset(request()->grade) && in_array('D',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_d"><span>Grade D</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]" id="grade_a_b" value="A-B" {{ (isset(request()->grade) && in_array('A-B',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_a_b"><span>Grade A/B</span></label>
            <br>
            <input class="form-check-input" type="checkbox" name="grade[]" id="grade_c_d" value="C-D" {{ (isset(request()->grade) && in_array('C-D',request()->grade))?'checked':'' }}>
            <label class="form-check-label" for="grade_c_d"><span>Grade C/D</span></label>
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</button>
</form>
