canvas = O('logo')
context = canvas.getContext('2d')
context.font = 'bold italic 97px Georgia'
context.textBaseline = 'top'
image = new Image()
image.src = 'Friends4Lyf.png'
image.onload = function(){
    context.drawImage(image, 180, 0, 240, 120)
}

function O(obj)
{
    if (typeof obj == 'object') return obj
    else return document.getElementById(obj)
}

function S(obj)
{
    return O(obj).style
}

function C(name)
{
    var elements = document.getElementsByTagName('*')
    var objects = []

    for (var i = 0; i<elements.length; ++i)
    {
        if (elements[i].className == name)
            objects.push(elements[i])
    }
    return objects
}