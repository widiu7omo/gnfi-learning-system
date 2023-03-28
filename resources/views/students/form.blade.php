<fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" class="block mt-1 w-full" type="text"
                      :init-value="$student->name ?? ''" name="name" :value="old('name')"
                      required
                      autofocus autocomplete="name"/>
        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
    </div>
    <div>
        <x-input-label for="email" :value="__('Email')"/>
        <x-text-input :init-value="$student->email ?? ''" id="email" class="block mt-1 w-full" type="text" name="email"
                      :value="old('email')"
                      required/>
        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
    </div>
    <div>
        <x-checkbox id="verified" name="verified" label="Verified"/>
    </div>
</fieldset>
