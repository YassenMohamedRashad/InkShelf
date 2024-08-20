<div
    wire:ignore
    x-data
    x-init="
        FilePond.create($refs.input, {
            labelIdle: '{{__('Drag and drop or choose image')}}',
            allowImagePreview: true,
            allowMultiple: false,
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                }
            }
        });
    ">
    <input {{ $attributes->merge(['type' => 'file', 'x-ref' => 'input']) }} />
</div>
