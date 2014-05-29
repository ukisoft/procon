import java.util.Iterator;

public class MyVector implements Iterable, Iterator {

    private int objectSize = 0;
    private Object[] objects;
    private int iteratorIndex = 0;

    MyVector(Object... objects)
    {
        this.objectSize = objects.length;
        if (this.objectSize < 2147483647 / 2) {
            this.objects = new Object[this.objectSize * 2];
        } else if (this.objectSize >= 2147483647 / 2 && this.objectSize < 2147483647) {
            this.objects = new Object[2147483647];
        } else {
            throw new OutOfMemoryError();
        }
        for (int i = 0; i < this.objectSize; i++) {
        this.objects[i] = objects[i];
        }
    }

    MyVector()
    {
        objects = new Object[8];
    }

    public boolean add(Object object)
    {
        if (this.objectSize >= this.objects.length) this.extendMemory();
        this.objects[this.objectSize++] = object;
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
        for (int i = index; i < this.objectSize - 1; i++) {
            this.objects[i] = this.objects[i + 1];
        }
        this.objectSize--;
        return oldObject;
    }

    public void insert(int index, Object object)
    {
        if (index == this.objectSize) {
            this.add(object);
            return;
        }
        if (this.isIndexOutOfBounds(index)) throw new ArrayIndexOutOfBoundsException(index);
        if (this.objectSize >= this.objects.length) this.extendMemory();
        for (int i = this.objectSize - 1; i >= index; i--) {
            this.objects[i + 1] = this.objects[i];
            if (i == index) this.objects[i] = object;
        }
        this.objectSize++;
    }

    public Object next()
    {
        return this.objects[this.iteratorIndex++];
    }

    public void remove()
    {
        this.remove(--this.iteratorIndex);
    }

    public boolean hasNext()
    {
        if (this.iteratorIndex < this.objectSize) return true;
        return false;
    }

    public Iterator iterator()
    {
        this.iteratorIndex = 0;
        return this;
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
        for (int i = 0; i < this.objectSize; i++) {
            if (i == 0) {
                stringBuilder.append(this.objects[i]);
            } else {
                stringBuilder.append(", " + this.objects[i]);
            }
        }
        return stringBuilder.toString();
    }
}
