<fieldset class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" class="block mt-1 w-full" type="text"
                      :init-value="$studyClass->name ?? ''" name="name" :value="old('name')"
                      required
                      autofocus autocomplete="name"/>
        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
    </div>
    <div class="col-span-2">
        <x-input-label for="desc" :value="__('Description')"/>
        <x-text-area :rows="5" :init-value="$studyClass->desc ?? ''" id="desc" class="block mt-1 w-full" name="desc"
                     :value="old('desc')"
                     required/>
        <x-input-error :messages="$errors->get('desc')" class="mt-2"/>
    </div>
</fieldset>
