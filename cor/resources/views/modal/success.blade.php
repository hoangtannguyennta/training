@if(session()->has('success'))
    <script >
    $.toast({
        heading: 'Success',
        text:  'Chúc mừng bạn đã thực hiện thành công chức năng',
        bgColor: '#FF1356',
        position: 'mid-center',
        stack: false
    })
    </script>
@endif
