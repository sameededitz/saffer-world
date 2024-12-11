<div>
    @if ($errors->any())
        <div class="py-2">
            @foreach ($errors->all() as $error)
                <x-alert type="danger" :message="$error" />
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="update">
        <div class="row gy-3">
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" wire:model.blur="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-12">
                <label class="form-label">Price</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" wire:model.blur="price" class="form-control" placeholder="Price">
            </div>
            <div class="col-12">
                <label class="form-label">Duration</label>
                <select wire:model.live="duration" class="form-control" required>
                    <option selected>Select Duration</option>
                    <option value="daily"> Daily </option>
                    <option value="weekly"> Weekly </option>
                    <option value="monthly"> Monthly </option>
                    <option value="3-month"> 3 Months </option>
                    <option value="6-month"> 6 Months </option>
                    <option value="yearly"> Yearly </option>
                    <option value="2-year"> 2 Year </option>
                    <option value="3-year"> 3 Year </option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <input type="text" wire:model.blur="description" class="form-control" placeholder="Description">
            </div>
            <div class="col-12">
                <label class="form-label">Type</label>
                <select wire:model.live="type" class="form-control" required>
                    <option selected>Select Type</option>
                    <option value="trial">Trial</option>
                    <option value="non_trial">Non Trial</option>
                </select>
            </div>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary-600">Update</button>
        </div>
    </form>
</div>
