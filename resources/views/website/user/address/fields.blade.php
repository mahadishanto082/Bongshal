<div class="row mb-2">
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            <label class="text-dark">Name *</label>

            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $userAddress->name ?? '') }}" placeholder="Name" required/>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label class="text-dark">Mobile *</label>

            <input type="number" name="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $userAddress->phone ?? '') }}" placeholder="Mobile Number"/>

            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label class="text-dark">Email</label>

            <input type="email"
                   class="form-control @error('email') is-invalid @enderror" name="email"
                   autocomplete="email" value="{{ old('email', $userAddress->email ?? '') }}" placeholder="Email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label class="text-dark">Address type *</label>

            <select name="address_type" class="custom-select @error('address_type') is-invalid @enderror" required>
                <option
                    value="primary" {{ old('address_type', $userAddress->address_type ?? '') == 'primary' ? 'selected' : '' }}>
                    Primary
                </option>

                <option
                    value="shipping" {{ old('address_type', $userAddress->address_type ?? '') == 'shipping' ? 'selected' : '' }}>
                    Shipping
                </option>

                <option
                    value="billing" {{ old('address_type', $userAddress->address_type ?? '') == 'billing' ? 'selected' : '' }}>
                    Billing
                </option>
            </select>

            @error('address_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label class="text-dark">Address *</label>

            <input type="text" name="address_line" class="form-control @error('address_line') is-invalid @enderror"
                   placeholder="Address" value="{{ old('address_line', $userAddress->address_line ?? '') }}" required>

            @error('address_line')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <label class="text-dark">District</label>

            <input type="text" name="district" class="form-control @error('district') is-invalid @enderror"
                   placeholder="City / Town" value="{{ old('district', $userAddress->district ?? '') }}">

            @error('district')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            <input id="delivery" class="checkbox-custom" name="is_default" value="1"
                   type="checkbox" {{ old('is_default', $userAddress->is_default ?? 1) ? 'checked' : '' }}>
            <label for="delivery" class="checkbox-custom-label">Set Default</label>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group text-center">
            <button type="submit" class="btn btn-dark full-width">Save</button>
        </div>
    </div>
</div>
