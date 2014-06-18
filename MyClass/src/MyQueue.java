
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
        if (this.myLinkedList.size() <= 0) {
            throw new NullPointerException();
        }
        return this.myLinkedList.remove(0);
    }

    public Object poll()
    {
        if (this.myLinkedList.size() <= 0) {
            return null;
        }
        return this.myLinkedList.remove(0);
    }

    public Object element()
    {
        if (this.myLinkedList.size() <= 0) {
            throw new NullPointerException();
        }
        return this.myLinkedList.get(0);
    }

    public Object peek()
    {
        if (this.myLinkedList.size() <= 0) {
            return null;
        }
        return this.myLinkedList.get(0);
    }

    @Override
    public String toString()
    {
        return this.myLinkedList.toString();
    }
}
