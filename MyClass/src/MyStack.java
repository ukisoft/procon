
public class MyStack {

    private MyVector myVector;

    MyStack()
    {
        this.myVector = new MyVector();
    }

    MyStack(Object... objects)
    {
        this.myVector = new MyVector(objects);
    }

    public void push(Object object)
    {
        this.myVector.add(object);
    }

    public void offerFirst(Object object)
    {
        this.push(object);
    }

    public Object remove()
    {
        if (this.myVector.size() <= 0) {
            throw new NullPointerException();
        }
        return this.myVector.remove(this.myVector.size() - 1);
    }

    public Object poll()
    {
        if (this.myVector.size() <= 0) {
            return null;
        }
        return this.myVector.remove(this.myVector.size() - 1);
    }

    public Object element()
    {
        if (this.myVector.size() <= 0) {
            throw new NullPointerException();
        }
        return this.myVector.get(this.myVector.size() - 1);
    }

    public Object peek()
    {
        if (this.myVector.size() <= 0) {
            return null;
        }
        return this.myVector.get(this.myVector.size() - 1);
    }

    @Override
    public String toString()
    {
        return this.myVector.toString();
    }
}
