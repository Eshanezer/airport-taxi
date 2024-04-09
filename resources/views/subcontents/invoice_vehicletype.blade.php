@foreach ($data as $pricing)
    <div class='col-md-4 text-center'>
        <input type="radio" name="vtimg" onclick="addToInvoice({{ $pricing->id }})" id="vtimglabel{{ $pricing->vehicletype }}"
            class="d-none imgbgchk round">
        <label for="vtimglabel{{ $pricing->vehicletype }}" class="border border-light">
            <img style="height: 80px" class="w-100" src="{{ getUploadsPath($pricing->vehicletypedata->path) }}"
                alt="{{ $pricing->vehicletypedata->type }}">
            <div class="tick_container ">
                <div class="tick"><i class="fa fa-check"></i></div>
            </div>
        </label>
    </div>
@endforeach
