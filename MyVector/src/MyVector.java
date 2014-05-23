import java.util.Iterator;

public class MyVector implements Iterator {

    private int objectSize = 0;
    private Object[] objects;
    private int iteratorIndex = 0;

    public void MyVector(Object... objects)
    {
        this.objectSize = objects.length;
        this.objects = new Object[this.objectSize * 2];
        for (int i = 0; i < this.objectSize; i++) {
            this.objects[i] = objects[i];
        }
    }

    public void MyVector()
    {
        objects = new Object[8];
    }

    public boolean add(Object object)
    {
        if (this.objectSize >= this.objects.length) this.extendMemory();
        this.objects[this.objectSize - 1] = object;
        this.objectSize++;
        return true;
    }

    public boolean contains(Object object)
    {
        for (int i = 0; i < this.objectSize; i++) {
            if (this.objects[i].equals(object)) return true;
        }
        return false;
    }

    public Object get(int index)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        return this.objects[index];
    }

    public Object set(int index, Object object)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        Object oldObject = this.objects[index];
        this.objects[index] = object;
        return oldObject;
    }

    public int size()
    {
        return this.objectSize;
    }

    public Object remove(int index)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        Object oldObject = this.objects[index];
        for (int i = index; i < this.objectSize; i++) {
            this.objects[i] = this.objects[i + 1];
        }
        this.objectSize--;
        return oldObject;
    }

    public Object insert(int index, Object object)
    {
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        if (this.objectSize >= this.objects.length) this.extendMemory();
        Object oldObject = this.objects[index];
        for (int i = this.objectSize - 1; i >= index; i--) {
            if (i != index) this.objects[i + 1] = this.objects[i];
            else this.objects[i] = object;
        }
        this.objectSize++;
        return oldObject;
    }

    public Object next()
    {
        Object nextObject = this.objects[this.iteratorIndex];
        this.iteratorIndex++;
        return nextObject;
    }

    public void remove()
    {
        this.remove(this.iteratorIndex);
        this.iteratorIndex--;
    }

    public boolean hasNext()
    {
        if (this.iteratorIndex < this.objectSize) return true;
        return false;
    }

    private void extendMemory()
    {
        Object[] newObjects = new Object[this.objects.length * 2];
        for (int i = 0; i < this.objects.length; i++) {
            newObjects[i] = this.objects[i];
        }
        this.objects = newObjects;
    }

    private boolean isIndexOutOfBounds(int index)
    {
        return index < 0 || index > this.objectSize - 1;
    }

    @Override
    public String toString() {
        StringBuilder stringBuilder = new StringBuilder();
        while (this.hasNext()) {
            stringBuilder.append(this.next());
        }
        return stringBuilder.toString();
    }
}
