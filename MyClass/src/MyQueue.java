
public class MyQueue {

    private MyLinkedList myLinkedList;

    MyQueue()
    {
        this.myLinkedList = new MyLinkedList();
    }

    MyQueue(Object... objects)
    {
        this.myLinkedList = new MyLinkedList(objects);
    }

    public void add(Object object)
    {
        boolean result = this.myLinkedList.add(object);
        if (result == false) {
            throw new InternalError();
        }
    }

    public void offer(Object object)
    {
        this.myLinkedList.add(object);
    }

    public Object remove()
    {
        Object object = null;
        try {
            object = this.myLinkedList.remove(0);
        } catch (ArrayIndexOutOfBoundsException e) {
            throw new NullPointerException();
        }

        if (object == null) {
            throw new NullPointerException();
        }
        return object;
    }

    public Object poll()
    {
        try {
            return this.myLinkedList.remove(0);
        } catch (ArrayIndexOutOfBoundsException e) {
            throw new NullPointerException();
        }
    }

    public Object element()
    {
        Object object = null;
        try {
            object = this.myLinkedList.get(0);
        } catch (ArrayIndexOutOfBoundsException e) {
            throw new NullPointerException();
        }
        if (object == null) {
            throw new NullPointerException();
        }
        return object;
    }

    public Object peek()
    {
        try {
            return this.myLinkedList.get(0);
        } catch (ArrayIndexOutOfBoundsException e) {
            throw new NullPointerException();
        }
    }

    @Override
    public String toString()
    {
        return this.myLinkedList.toString();
    }
}
